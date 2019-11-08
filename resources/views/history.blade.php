@unless (Route::is('*.create'))

<div class="col-7">
    <div class="float-right bg-light">
        <small class="mb-0">&nbsp;Created by
            {{ is_array($model) ? optional($model['creator'])['name'] : optional($model->creator)->name }}
            on
            {{ is_array($model) ? optional($model)['created_at'] : optional($model->created_at)->toDayDateTimeString() }}</small>
        <br>
        <small class="mt-0">&nbsp;Updated by
            {{ is_array($model) ? optional($model['editor'])['name'] : optional($model->editor)->name }} on
            {{ is_array($model) ? optional($model)['updated_at'] : optional($model->updated_at)->toDayDateTimeString() }}</small>
    </div>
</div>

@endunless