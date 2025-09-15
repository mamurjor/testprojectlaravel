<?php

namespace App\Traits;


use Illuminate\Support\Str;


trait GeneratesSlug
{
protected static function bootGeneratesSlug()
{
static::creating(function ($model) {
if (empty($model->slug) && isset($model->title)) {
$model->slug = static::uniqueSlug($model->title);
}
if (empty($model->slug) && isset($model->name)) {
$model->slug = static::uniqueSlug($model->name);
}
});
}


protected static function uniqueSlug(string $value): string
{
$slug = Str::slug($value);
$original = $slug;
$i = 2;
$model = new static;
while ($model::where('slug', $slug)->exists()) {
$slug = $original.'-'.$i++;
}
return $slug;
}
}

?>
