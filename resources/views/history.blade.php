@unless (Route::is('*.create'))

<div class="col-7">
    <div class="float-right bg-light">
        <small class="mb-0">&nbsp;Created by
            {{ optional($model->creator)->name }}
            on
            {{ optional($model->created_at)->toDayDateTimeString() }}</small>
        <br>
        <small class="mt-0">&nbsp;Updated by
            {{ optional($model->editor)->name }} on
            {{ optional($model->updated_at)->toDayDateTimeString() }}</small>
    </div>
</div>

@endunless