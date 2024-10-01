<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Article') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Edit the article.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('article.update', $article) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="edit_article_title" :value="__('Title')" />
                                <x-text-input id="edit_article_title" name="title" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('title', $article->title)" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="edit_article_image" :value="__('Image')" />
                                <x-file-input id="edit_article_image" name="image_path" type="file" class="mt-1 block w-full" accept=".jpg,.png,.bmp" />
                                <x-input-error :messages="$errors->get('image_path')" class="mt-2" />

                                <img src="{{ $article->image_url }}" class="max-w-24 rounded mt-3" />
                            </div>

                            <div>
                                <x-input-label for="edit_article_link" :value="__('Link')" />
                                <x-text-input id="edit_article_link" name="link" type="url" class="mt-1 block w-full" :value="old('link', $article->link)" />
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="edit_article_content" :value="__('Content')" />
                                <x-text-area id="edit_article_content" name="content" class="mt-1 block w-full">{{ old('content', $article->content) }}</x-text-area>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="edit_article_company" :value="__('Company')" />
                                <select id="edit_article_company" name="company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select company...</option>
                                    @foreach ($companies as $company)
                                    <option @if(old('company_id', $article->company_id) === $company->id) selected @endif value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                @if (auth()->user()->is_editor)
                                <x-primary-button name="action" value="save">{{ __('Save') }}</x-primary-button>

                                @if ($article->status === App\Enums\ArticleStatus::FOR_EDIT)
                                <x-primary-button name="action" value="publish">{{ __('Publish') }}</x-primary-button>
                                @endif
                                
                                @else
                                <x-primary-button>{{ __('Edit') }}</x-primary-button>
                                @endif
                                <x-secondary-button-link :href="route('dashboard')">{{ __('Cancel') }}</x-secondary-button-link>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>