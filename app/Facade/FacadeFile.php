<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class FacadeFile extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'staticfacadefile';
    }
}

?>
