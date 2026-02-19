<div class="flex items-center gap-2 px-2">
    <a href="{{ request()->fullUrlWithQuery(['locale' => 'en']) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors
              {{ app()->getLocale() === 'en'
    ? 'bg-primary-500 text-white shadow-sm'
    : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800' }}" title="English">
        <span>EN</span>
    </a>

    <span class="text-gray-300 dark:text-gray-600">|</span>

    <a href="{{ request()->fullUrlWithQuery(['locale' => 'vi']) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors
              {{ app()->getLocale() === 'vi'
    ? 'bg-primary-500 text-white shadow-sm'
    : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800' }}" title="Tiếng Việt">
        <span>VI</span>
    </a>

    <span class="text-gray-300 dark:text-gray-600">|</span>

    <a href="{{ request()->fullUrlWithQuery(['locale' => 'th']) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors
              {{ app()->getLocale() === 'th'
    ? 'bg-primary-500 text-white shadow-sm'
    : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800' }}" title="ภาษาไทย">
        <span>TH</span>
    </a>
</div>