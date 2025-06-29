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
                            <a href="{{ route('scores.index') }}"
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
