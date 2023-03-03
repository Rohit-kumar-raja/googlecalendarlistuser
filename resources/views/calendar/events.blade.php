
    <div class="container">
        <h1>Google Calendar Events</h1>
        <ul>
            @foreach ($events as $event)
                <li>{{ $event->getSummary() }} - {{ $event->getStart()->getDateTime() }}</li>
            @endforeach
        </ul>
    </div>
