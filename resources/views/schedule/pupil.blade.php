<x-pupil-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Расписание на неделю</a>
            </div>
        </nav>
    </div>

    @if($schedule->id>0)
        <div class="container">
            <div class="bg-light p-4 rounded mt-4">
                <ul class="nav nav-pills mb-3" id="weeks-tab" role="tablist">
                    @foreach($week as $dayNum => $dayWeek)
                        @php($style='')
                        @if(date('w')==$dayNum)
                            @php($style="active")
                        @endif
                        <li class="nav-item" role="presentation">
                            <button data-day="{{$dayNum}}" class="nav-link {{$style}}" id="week-day{{$dayNum}}-tab"
                                    data-bs-toggle="week"
                                    data-bs-target="#week-day{{$dayNum}}" type="button" role="tab"
                                    aria-controls="week-day"
                                    aria-selected="true">{{$dayWeek}} {{$days[$dayNum]}}</button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="weeks-tabContent">
                    @foreach($week as $dayNum => $dayWeek)
                        @php($style='')
                        @if(date('w')==$dayNum)
                            @php($style="active")
                        @endif

                        <div class="tab-pane fade show {{$style}}" id="week-day{{$dayNum}}"
                             role="tabpanel" aria-labelledby="pills-home-tab"
                             tabindex="0">
                            @if(isset($lessons[$dayNum]) && @count($lessons[$dayNum]))
                                @foreach($lessons[$dayNum] as $lesson)

                                    <div class="container">
                                        <div class="col-5">
                                            <div style="background: #d5e6ff" class="p-4 rounded mt-4">
                                                {{$lesson->title}} <sup>({{$lesson->num_minutes}} мин.)</sup>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <div class="container">
                                    <div style="background: #a2ecae" class="p-4 rounded mt-4 text-center">
                                        Уроков нет
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="bg-light p-4 rounded mt-4">
                <div class="text-center fs4">Расписание отсутствует</div>
            </div>
        </div>
    @endif


    <script src="{{ asset('js/schedule.js') }}" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#weeks-tab > li').on('click', function () {
                $('#weeks-tab li > button').removeClass('active');
                $(this).find('button').addClass('active');
                let day = $(this).find('button').data('day');
                $("#weeks-tabContent > .tab-pane").removeClass('active');
                $('#week-day' + day).addClass('active');
            });
        });
    </script>
</x-pupil-layout>
