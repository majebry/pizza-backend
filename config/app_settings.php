<?php

return \Spatie\Valuestore\Valuestore::make(
    storage_path('settings.json')
)->all();
