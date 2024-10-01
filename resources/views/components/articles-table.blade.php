@props(['articles'])

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-6 space-y-6">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID
            </th>
            <th scope="col" class="px-6 py-3">
                Title
            </th>
            <th scope="col" class="px-6 py-3">
                Image
            </th>
            <th scope="col" class="px-6 py-3">
                Writer
            </th>
            <th scope="col" class="px-6 py-3">
                Editor
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Created At
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($articles as $article)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $article->id }}
            </th>
            <td class="px-6 py-4">
                <a href="{{ $article->link }}" target="_blank" class="underline">{{ $article->title }}</a>
            </td>
            <td class="px-6 py-4">
                <img src="{{ $article->image_url }}" class="max-w-24 rounded" />
            </td>
            <td class="px-6 py-4">
                {{ $article->writer->name }}
            </td>
            <td class="px-6 py-4">
                {{ $article->editor?->name ?? '-' }}
            </td>
            <td class="px-6 py-4">
                {{ $article->status }}
            </td>
            <td class="px-6 py-4">
                {{ $article->created_at->setTimezone('Asia/Manila') }}
            </td>
            <td class="px-6 py-4">
                @if ($article->canEdit(Auth::user()))
                <x-secondary-button-link :href="route('article.edit', $article)">Edit</x-secondary-button-link>
                @endif
            </td>
        </tr>
        @empty
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td colspan="8" class="px-6 py-4 text-center">
                {{ __('Nothing to display!') }}
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- TODO: Implement pagination -->