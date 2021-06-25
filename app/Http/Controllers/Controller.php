<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
  protected $query;
  protected $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function res($message, int $statusCode = 200)
  {
    return response()->json($message, $statusCode);
  }

  protected static function errorValidation($field, $messege)
  {
    throw ValidationException::withMessages([$field => [$messege]]);
  }

  protected function filter($fields = [], $relations = [])
  {
    $selects = collect();

    foreach ($relations as $relation) {
      if (isset($relation['fields'])) {
        $relationName = $relation['name'];
        $relationTable = $relation['table'] ?? (new Model)->getConnection()->getTablePrefix() . Str::plural($relation['name']);
        $foreignId = $relation['foreign_id'] ?? 'id';

        $relationId = $relation['id'] ?? $relation['name'] . '_id';

        foreach ($relation['fields'] as $field) {
          $fields[] = "{$relationName}_{$field}";
          $selects->push("(select $relationTable.$field from $relationTable where $relationTable.$foreignId = $relationId) AS {$relationName}_{$field}");
        }
      }
    }

    if ($selects->isNotEmpty()) {
      $this->query->selectRaw($selects->implode(','));
    }

    $this->filterMatch($fields);

    if ($this->request->has('q') && $this->query->getModel()->keywordField) {
      $this->query->where($this->query->getModel()->keywordField, 'like', "%{$this->request->q}%");
    }

    if ($this->request->has('orderby')) {
      $orderBy = str_replace('.', '_', $this->request->orderby);

      if (in_array($orderBy, $fields)) {
        $this->query->orderBy($orderBy, $this->request->sort ?? 'desc');
      }
    }

    $this->query->toSql();
  }

  protected function filterMatch($params)
  {
    foreach ($params as $param) {
      $min = "{$param}>";
      $max = "{$param}<";
      $whereNot = "{$param}!";
      $notLike = "{$param}~!";
      $like = "{$param}~";
      $notIn = "{$param}-not-in";
      $in = "{$param}-in";

      if ($this->request->has($param)) {
        $this->query->having($param, $this->request->$param);
      }

      if ($this->request->has($whereNot)) {
        $this->query->having($param, '!=', $this->request->$whereNot);
      }

      if ($this->request->has($min)) {
        $this->query->having($param, '>=', $this->request->$min);
      }

      if ($this->request->has($max)) {
        $this->query->having($param, '<=', $this->request->$max);
      }

      if ($this->request->has($like)) {
        $this->query->having($param, 'like', "%{$this->request->$like}%");
      }

      if ($this->request->has($notLike)) {
        $this->query->having($param, 'not like', "%{$this->request->$notLike}%");
      }

      if ($this->request->has($notIn)) {
        $this->query->havingRaw("{$param} notin (" . explode(',', $this->request->$notIn) . ")");
      }

      if ($this->request->has($in)) {
        $this->query->havingRaw("{$param} in (" . explode(',', $this->request->$in) . ")");
      }
    }
  }

  protected function saveAvatar($model): void
  {
    if ($this->request->has('avatar')) {
      $model->addMediaFromRequest('avatar')->toMediaCollection('avatar');
    }
  }

  protected function saveThumbnail($model): void
  {
    if ($this->request->has('thumbnail')) {
      $model->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');

      if ($model->getMedia('thumbnail')->count() > 1) {
        $model->getMedia('thumbnail')->first()->delete();
      }
    }
  }

  protected function saveFiles($model): void
  {
    if ($this->request->has('files')) {
      foreach ($this->request->file('files') as $file) {
        $model->addMedia($file)->toMediaCollection('files');
      }
    }
  }

  protected function saveMedia($model): void
  {
    $this->saveThumbnail($model);
    $this->saveFiles($model);
  }
}
