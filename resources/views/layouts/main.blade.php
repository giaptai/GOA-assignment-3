<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Layout</title>
</head>

<body>
    <main class="bg-[#f8f9fa]">
        {{-- HEADER --}}
        <header class="bg-[#0f2289] py-7 text-center font-semibold text-2xl text-white w-full">
            <p>G-Scores</p>
        </header>

        <section class="flex flex-col md:flex-row min-h-[calc(100vh_-_87.98px)]">
            {{-- SIDEBAR --}}
            <aside class="basis-xs border-r border-gray-50 bg-white">
                <div class="p-2 font-semibold">
                    <!-- Be present above all else. - Naval Ravikant -->
                    <h1 class="text-center text-2xl my-9 text-[#0f2289]">Menu</h1>
                    <hr / class="text-[#0f2289] mb-2">
                    <ul class="flex flex-col p-4 gap-y-6">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="block p-3 border-r-8 {{ request()->segment(1) == 'dashboard' ? 'bg-[#0f2289] text-blue-50' : '' }} border-[#0f2289] text-[#0f2289] hover:bg-[#0f2289] hover:text-blue-50">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('scores') }}"
                                class="block p-3 border-r-8 {{ request()->segment(1) == 'scores' ? 'bg-[#0f2289] text-blue-50' : '' }} border-[#0f2289] text-[#0f2289] hover:bg-[#0f2289] hover:text-blue-50">
                                <span>Search Scores</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reports') }}"
                                class="block p-3 border-r-8 {{ request()->segment(1) == 'reports' ? 'bg-[#0f2289] text-blue-50' : '' }} border-[#0f2289] text-[#0f2289] hover:bg-[#0f2289] hover:text-blue-50">
                                <span>Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings') }}"
                                class="block p-3 border-r-8 {{ request()->segment(1) == 'settings' ? 'bg-[#0f2289] text-blue-50' : '' }} border-[#0f2289] text-[#0f2289] hover:bg-[#0f2289] hover:text-blue-50">
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="px-14 py-9 w-full">
                @yield('main-content')

                {{-- <div>
                    <div class="card bg-white px-7 py-11 shadow-md rounded-xl mb-6">
                        <h1 class="font-bold text-2xl text-[#0f2289] mb-4">User Registration</h1>
                        <h3 class="mb-2 text-[#0f2289]">Registration Number:</h3>
                        <div class="flex flex-col sm:flex-row gap-y-1.5 sm:gap-x-1.5">
                            <input class="px-3 py-1.5 border-2 rounded-md border-gray-300 w-12/12 sm:w-3/12"
                                type="text" value="" name="search-number"
                                placeholder="Enter registration number">
                            <button class="px-5 py-1.5 bg-[#0f2289] rounded-md text-white"
                                type="button">Submit</button>
                        </div>
                    </div>

                    <div class="card bg-white px-7 py-11 shadow-md rounded-xl">
                        <h1 class="font-bold text-2xl text-[#0f2289] mb-4">Detailed Scores</h1>
                        <h3 class="mb-2 text-[#0f2289]">Detailed view of search scores here!</h3>
                        <div class="flex gap-x-1.5">
                            <div class="flex flex-col grow">
                                <div class="-m-1.5 overflow-x-auto">
                                    <div class="p-1.5 min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200 ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            SBD</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Toán
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Ngữ văn</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Ngoại ngữ</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Vật lý</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Hóa học</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Sinh học</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Lịch sử</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Đia lí</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            GDCD</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                            Mã ngoại ngữ</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                            00212389</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">5
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">6
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">7
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">2
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                            <button type="button"
                                                                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </section>
    </main>
</body>

</html>
