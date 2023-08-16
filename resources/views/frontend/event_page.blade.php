<div class="logo_area text-center">
    <h2 class="logo">RSVP Event list</h2>
</div>

<div class="event_area section_padding">
    <div class="container">
        <div class="row">
            @foreach ($all_event as $item )

            <div class="col-md-3 py-3">
                <div class="single_event">

                    <div class="card">
                        <div class="card-body">
                                <div class="date_time">
                                    <p class="date" id="event_date">{{$item->date}}</p>
                                    <p class="time" id="event_time">{{$item->time}}</p>
                                </div>
                                <div class="event_body text-center">
                                    <h3 class="title" id="event_title">{{$item->title}}</h3>
                                <a href="" class="btn get_detail_btn">Interest</a>
                                </div>
                                <div class="event_footer text-center">
                                    <p class="location" id="event_location">{{$item->location}}</p>
                                    <input type="text" id="event_id" class="d-none">
                                </div>
                        </div>
                      </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
