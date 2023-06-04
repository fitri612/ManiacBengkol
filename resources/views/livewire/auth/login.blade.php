<div>
    <section class="dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="{{ url('/') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://gcdnb.pbrd.co/images/4LUQpWQfxfra.png?o=1" width="55px" height="55px" alt="logo">
                Maniac Bengkol    
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Masuk ke akun anda
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit.prevent="loginUser">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input wire:model.defer="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                            @error('email') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" placeholder="name@company.com" >
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh snap!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                            @error('password') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" >
                            @error('password')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">error</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                  <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" >
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="remember" class="text-gray-500 dark:text-gray-300">Ingat saya</label>
                                </div>
                            </div>
                            {{-- <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                                Forgot password?</a> --}}
                            <a href="{{ 'forgot-password' }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                                Lupa Pasword?</a>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Masuk</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                           Belum punya akun? <a href="{{ 'register' }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
      </section>

</div>
