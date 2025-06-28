{{-- kế thừa --}}
@extends('main')

@section('main-content')
    <div>
        <div class="card bg-white px-7 py-11 shadow-md rounded-xl mb-6">
            <h1 class="font-bold text-2xl text-[#0f2289] mb-4">User Registration</h1>
            <h3 class="mb-2 text-[#0f2289]">Registration Number:</h3>
            <span class="text-red-600 text-sm" id="message"></span>
            <div class="flex flex-col sm:flex-row gap-y-1.5 sm:gap-x-1.5 ">
                <input class="px-3 py-1.5 border-2 rounded-md border-gray-300 w-12/12 sm:w-3/12" type="text" value=""
                    id="sbd" name="sbd" placeholder="Enter registration number">
                <button id="submitBtn" class="px-5 py-1.5 bg-[#0f2289] rounded-md text-white" type="button"
                    onclick="">Submit</button>
            </div>
        </div>

        <div class="card bg-white px-7 py-11 shadow-md rounded-xl">
            <h1 class="font-bold text-2xl text-[#0f2289] mb-4">Detailed Scores</h1>
            <h3 class="mb-2 text-[#0f2289]">Detailed view of search scores here!</h3>
            <div class="flex gap-x-1.5">
                <div class="flex flex-col grow">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-x-auto w-full">
                            <table class="table-fixed w-full divide-y divide-gray-200 ">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            SBD</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Toán
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Ngữ văn</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Ngoại ngữ</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Vật lí</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Hóa học</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Sinh học</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Lịch sử</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Đia lí</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            GDCD</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs md:whitespace-nowrap font-medium text-gray-500 uppercase">
                                            Mã ngoại ngữ</th>
                                        {{-- <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="tbody-data">
                                    <tr>
                                        <td colspan="12" class="text-center py-2 italic text-gray-500">No data</td>
                                    </tr>
                                    {{-- <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
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
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            </td>
                                        </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const scoreUrl = @json(route('score.show'));
        const submitBtn = document.getElementById('submitBtn');
        const sbdInput = document.getElementById('sbd');

        sbdInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                getInfo();
            }
        });

        submitBtn.addEventListener('click', () => {
            getInfo();
        });

        async function getInfo() {
            const sbd = document.getElementById('sbd').value;
            const resultTbody = document.getElementById('tbody-data');
            try {
                const res = await fetch(`${scoreUrl}?q=${encodeURIComponent(sbd)}`);
                const data = await res.json();

                if (!res.ok) {
                    console.log(data);
                    message.innerHTML = data.message;
                     resultTbody.innerHTML =`<tr>
                        <td colspan="12" class="text-center py-2 italic text-gray-500">No data</td>
                    </tr>`
                } else {
                    message.innerHTML = '';
                    resultTbody.innerHTML =
                        `<tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">${data.sbd}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.toan ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.ngu_van ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.ngoai_ngu ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.vat_li ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.hoa_hoc ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.sinh_hoc ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.lich_su ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.dia_li ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.gdcd ?? ''}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${data.ma_ngoai_ngu ?? ''}</td>
                        </tr>`
                }
            } catch (err) {
                console.error("Lỗi fetch:", err);
            }
        }
    </script>
@endsection
