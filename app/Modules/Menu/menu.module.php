<?php

use Helpers\Hooks;
Hooks::addHook('routes', 'Modules\Menu\Controllers\Menu@routes');
