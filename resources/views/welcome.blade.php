@extends('app')

@section('content')
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-xl lg:flex-row">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-9 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <h1 class="mb-1 font-medium"></h1>
                    <div class="text-sm leading-normal">
                        <div class="flex">
                            <div class="bg-blue-500 text-white rounded p-1 px-3">Hi</div>
                        </div>
                        <div class="flex justify-end">
                            <div class="flex gap-1">
                                <div class="bg-green-500 rounded-full w-[30px] h-[30px] text-white text-xs flex justify-center items-center">me</div>
                                <div class="bg-blue-500 text-white rounded p-1 px-3">Hlw</div>
                            </div>
                        </div>
                    </div>
                    <form id="send-msg-form" action="{{ route('message.store') }}" method="POST">
                        @csrf
                        <label for="message">Message</label>
                        <div class="flex gap-1">
                            <input type="text" name="message" class="w-full border-1 border-gray-400 rounded h-[3em] px-5">
                        
                            <button type="submit" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </main>
    </div>
@endsection

@push('js')
     <script>
            const form = document.getElementById('send-msg-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const url = e.currentTarget.action;
                const formData = new FormData(e.currentTarget);
                const res = await axios.post(url, formData);
                if(res.status === 200){
                    console.log(res.data);
                }
            });
        
        </script>
@endpush