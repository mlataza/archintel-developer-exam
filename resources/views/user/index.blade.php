<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <x-alert />

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create User') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Create a new user.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="create_user_firstname" :value="__('Firstname')" />
                                <x-text-input id="create_user_firstname" name="firstname" type="text" class="mt-1 block w-full" autocomplete="firstname" :value="old('firstname')" />
                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_lastname" :value="__('Lastname')" />
                                <x-text-input id="create_user_lastname" name="lastname" type="text" class="mt-1 block w-full" autocomplete="lastname" :value="old('lastname')" />
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_email" :value="__('Email')" />
                                <x-text-input id="create_user_email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" :value="old('email')" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_password" :value="__('Password')" />
                                <x-text-input id="create_user_password" name="password" type="password" class="mt-1 block w-full" autocomplete="password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_password_confirmation" :value="__('Password Confirmation')" />
                                <x-text-input id="create_user_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="password_confirmation" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_type" :value="__('Type')" />
                                <select id="create_user_type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select user type...</option>
                                    <option @if(old('type') === "Writer") selected @endif>Writer</option>
                                    <option @if(old('type') === "Editor") selected @endif>Editor</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="create_user_status" :value="__('Status')" />
                                <select id="create_user_status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select user status...</option>
                                    <option @if(old('status') == "Active") selected @endif>Active</option>
                                    <option @if(old('status') == "Inactive") selected @endif>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                                {{ __('List of Users') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('List of users stored in the system.') }}
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
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->created_at->setTimezone('Asia/Manila') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->updated_at->setTimezone('Asia/Manila') }}
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