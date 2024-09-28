<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create Company') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Create a new company to write articles about.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('company.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="create_company_name" :value="__('Name')" />
                                <x-text-input id="create_company_name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('name')" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_company_logo" :value="__('Logo')" />
                                <x-file-input id="create_company_logo" name="logo" type="file" class="mt-1 block w-full" accept=".jpg,.png,.bmp" :value="old('logo')" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('List of Companies') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('List of companies stored in the system.') }}
                            </p>
                        </header>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-6 space-y-6">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Logo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Updated At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $company->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $company->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="{{ $company->logo_url }}" class="max-w-24 rounded" />
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $company->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $company->created_at->setTimezone('Asia/Manila') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $company->updated_at->setTimezone('Asia/Manila') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-secondary-button-link :href="route('company.edit', $company)">Edit</x-secondary-button-link>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="7" class="px-6 py-4 text-center">
                                        {{ __('Nothing to display!') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>