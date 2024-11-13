<!-- media/activity.blade.php -->
<div class="activity-log">
    <h6>Activity Log</h6>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Activity</th>
                <th scope="col">Activity</th>
                <th scope="col">Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @if($activities->isNotEmpty())
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->id_activity }}</td>
                        <td>{{ $activity->activity }}</td>
                        <td>{{ $activity->timestamp }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No activities found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
