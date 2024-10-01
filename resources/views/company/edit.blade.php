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
                                {{ __('Edit Company') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update the company details.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('company.update', $company) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="edit_company_name" :value="__('Name')" />
                                <x-text-input id="edit_company_name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('name', $company->name)" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="edit_company_logo" :value="__('Logo')" />
                                <x-file-input id="edit_company_logo" name="logo_path" type="file" class="mt-1 block w-full" accept=".jpg,.png,.bmp" />
                                <x-input-error :messages="$errors->get('logo_path')" class="mt-2" />

                                <img src="{{ $company->logo_url }}" class="max-w-24 rounded mt-3" />
                            </div>

                            <div>
                                <x-input-label for="edit_company_status" :value="__('Status')" />
                                <select id="edit_company_status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option @if(old('status', $company->status) === App\Enums\CompanyStatus::ACTIVE) selected @endif>Active</option>
                                    <option @if(old('status', $company->status) === App\Enums\CompanyStatus::INACTIVE) selected @endif>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                                <x-secondary-button-link :href="route('company.index')">{{ __('Cancel') }}</x-secondary-button-link>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>