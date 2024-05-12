<?php

namespace Motor\Mvc\Components;

use Motor\Mvc\Interfaces\DebugInterface;

class Debug implements DebugInterface
{
    public static function view(mixed $data)
    {
        $count = count((array) $data);
        echo '<div id="contain-debug" class="border-t-2 border-black fixed bottom-0 left-0 right-0 w-full z-50 flex-colum debug-min">
      <div class="flex flex-row bg-gray-700 justify-evenly w-50 m-auto p-2">
        <div class="rounded-full px-2 bg-white my-auto">DATA : <span class="text-yellow-700 font-medium">' .
        $count .
        '</span></div>
        <div class="rounded-full px-2 bg-white my-auto">POST : <span class="text-yellow-700 font-medium">' .
        count($_POST) .
        '</span></div>
        <div class="rounded-full px-2 bg-white my-auto">GET : <span class="text-yellow-700 font-medium"> ' .
        count($_GET) .
        '</span></div>
        <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2" data-js="debugToggle,click" data-id="contain-debug,pre-debug">ouvrir</button>
     </div> 
      <pre id="pre-debug" class=" flex bg-gray-300 p-5 rounded-md overflow-y-scroll text-yellow-700 text-sm min-h-20">',
            var_dump($data),
            '</pre>
    </div>
    ';
    }
}
