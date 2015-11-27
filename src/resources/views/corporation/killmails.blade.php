@extends('web::corporation.layouts.view', ['viewname' => 'killmails'])

@section('title', ucfirst(trans_choice('web::corporation.corporation', 1)) . ' Killmails')
@section('page_header', ucfirst(trans_choice('web::corporation.corporation', 1)) . ' Killmails')

@section('corporation_content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Killmails</h3>
    </div>
    <div class="panel-body">

      <table class="table table-condensed table-hover table-responsive">
        <tbody>
        <tr>
          <th>Date</th>
          <th>Victim</th>
          <th>Ship Type</th>
          <th>Location</th>
          <th></th>
        </tr>

        @foreach($killmails as $killmail)

          <tr>
            <td>
              <span data-toggle="tooltip"
                    title="" data-original-title="{{ $killmail->killTime }}">
                {{ human_diff($killmail->killTime) }}
              </span>
            </td>
            <td>
              {!! img('character', $killmail->characterID, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
              {{ $killmail->characterName }}

              @if($killmail->ownerID == $killmail->victimID)
                <span class="text-red">
                  <i>(loss!)</i>
                </span>
              @endif
            </td>
            <td>
              {!! img('type', $killmail->shipTypeID, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
              {{ $killmail->typeName }}
            </td>
            <td>
              {{ $killmail->itemName }}

              <span class="
                @if($killmail->security >= 0.5)
                      text-green
                    @elseif($killmail->security < 0.5 && $killmail->security > 0.0)
                      text-warning
                    @else
                      text-red
                    @endif">
                <i>({{ round($killmail->security,  2) }})</i>
              </span>
            </td>
            <td>
              <a href="https://zkillboard.com/kill/{{ $killmail->killID }}/" target="_blank" class="text-muted">
                <i class="fa fa-external-link"></i>
                zKillBoard
              </a>
            </td>
          </tr>

        @endforeach

        </tbody>
      </table>

    </div>
  </div>

@stop