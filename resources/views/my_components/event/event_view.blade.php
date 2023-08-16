<div class="modal" id="view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="date_time">
                    <p class="date" id="event_date"></p>
                    <p class="time" id="event_time"></p>
                </div>
                <div class="event_body">
                    <h3 class="title" id="event_title"></h3>
                    <p class="description" id="event_description"></p>
                </div>
                <div class="event_footer">
                    <p class="location" id="event_location"></p>
                    <input type="text" id="event_id" class="d-none">
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    async function FillUpUpdateForm(id) {
    document.getElementById('event_id').value = id;

    showLoader();
    let res = await axios.post("/event-by-id", { id: id})
    hideLoader();

    document.getElementById('event_title').innerHTML = res.data['title'];
    document.getElementById('event_description').innerHTML = res.data['description'];
    document.getElementById('event_date').innerHTML = res.data['date'];
    document.getElementById('event_time').innerHTML = res.data['time'];
    document.getElementById('event_location').innerHTML = res.data['location'];

}

</script>
