<?php

use Helpers\Hooks;
Hooks::addHook('routes', 'Modules\Users\Controllers\Users@routes');
