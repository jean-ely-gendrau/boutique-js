<form class="max-w-lg mx-auto w-full mt-0 md:mt-4">
    <div class="flex">
        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Rechercher</button>
        <label for="search-product" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
        <div class="relative w-full">
            <input type="text" id="search-product" class="ui-autocomplete-input block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Rechercher votre café ou thé" required autocomplete="off" />
            <div id="suggestions" class="absolute bg-white border border-gray-300 mt-1 w-full rounded-lg z-10"></div>
        </div>
    </div>
</form>