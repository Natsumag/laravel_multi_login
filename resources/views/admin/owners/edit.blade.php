<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Owner_Edit
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Owner Edit</h1>
                            </div>
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="post" action="{{ route('admin.owners.update', ['owner' => $owner->id]) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="-m-2">
                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                                <input type="text" id="name" name="name" value="{{ $owner->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="shop" class="leading-7 text-sm text-gray-600">Email</label>
                                                <input type="email" id="email" name="email" value="{{ $owner->email }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="email" class="leading-7 text-sm text-gray-600">Shop Name</label>
                                                <div class="w-full rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">@if(isset($owner->shop->name)){{ $owner->shop->name }}@endif</div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="password_same" class="leading-7 text-sm text-gray-600">Same Password</label>
                                                <div>
                                                    <input type="radio" id="password_same" name="password_same" value="1" checked onclick="PasswordChange(this)">
                                                    <label for="password_same">Not Change</label><br>
                                                    <input type="radio" id="password_change" name="password_same" value="0" onclick="PasswordChange(this)">
                                                    <label for="password_change">Change</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="password_display">
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                                                    <input type="password" id="password" name="password" disabled required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="password_confirmation" class="leading-7 text-sm text-gray-600">Password Confirm</label>
                                                    <input type="password" id="password_confirmation" name="password_confirmation" disabled required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <button type="button" onclick="location.href='{{ route('admin.owners.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                                            <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function PasswordChange (radio) {
            var rd_value = radio.value;
            var password = document.getElementById('password');
            var password_confirmation = document.getElementById('password_confirmation');
            console.log(rd_value);
            if (rd_value == "1") {
                password.disabled = true;
                password_confirmation.disabled = true;
                password_confirmation.required = false;
            }
            if (rd_value == "0") {
                password.disabled = false;
                password_confirmation.disabled = false;
                password_confirmation.required = true;
            }
        }
    </script>
</x-app-layout>
