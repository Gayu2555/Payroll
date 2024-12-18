<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Payroll Login</title>
</head>

<body class="h-screen w-screen flex items-center justify-center bg-gray-100">
    <div class="flex flex-row w-full max-w-3xl bg-white rounded-md shadow-md">
        <div class="left w-1/3 h-auto relative bg-cover rounded-l-md"
            style="background-image: url('https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-auto m-5" viewBox="0 0 300 302.5">
                <path fill="#fff"
                    d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z" />
            </svg>
        </div>
        <form class="log-in p-8 bg-white flex flex-col items-start w-2/3" autocomplete="off">
            <h4 class="text-2xl font-semibold text-black mb-5">
                We are <span class="font-bold text-purple-500">Payroll</span>
            </h4>
            <p class="text-sm text-gray-600 max-w-xs mb-6 leading-relaxed">
                Sebelum Masuk ke Payroll System pastikan kamu Login dengan Employe ID dan Password Karyawan kamu dulu
                ya.
            </p>

            <!-- Email Input -->
            <div class="relative w-full mb-4">
                <input type="email" name="email" id="email" placeholder="Email" autocomplete="off"
                    class="w-full h-12 text-sm px-12 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 24 24">
                        <path
                            d="M17.5 977c-1.3 0-2.4 1.1-2.4 2.4v45.9c0 1.3 1.1 2.4 2.4 2.4h64.9c1.3 0 2.4-1.1 2.4-2.4v-45.9c0-1.3-1.1-2.4-2.4-2.4h-64.9zm2.4 4.8h60.2v1.2l-30.1 22-30.1-22v-1.2zm0 7l28.7 21c0.8 0.6 2 0.6 2.8 0l28.7-21v34.1h-60.2v-34.1z" />
                    </svg>
                </div>
            </div>

            <!-- Password Input -->
            <div class="relative w-full mb-6">
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off"
                    class="w-full h-12 text-sm px-12 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 24 24">
                        <path
                            d="M19,21H5V9h14V21z M6,20h12V10H6V20z M16.5,10h-1V7c0-1.9-1.6-3.5-3.5-3.5S8.5,5.1,8.5,7v3h-1V7c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5V10z" />
                    </svg>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full h-12 bg-purple-500 text-white rounded-md text-sm font-medium shadow-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Log in
            </button>
        </form>
    </div>
</body>

</html>