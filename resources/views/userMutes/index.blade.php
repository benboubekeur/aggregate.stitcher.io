@php
    /** @var \Domain\User\Models\User $user */
    /** @var \Domain\Mute\Models\Mute[] $mutes */
@endphp

@component('layouts.user', [
    'title' => __('Mutes'),
])
    <x-heading>Mutes</x-heading>

    <div class="content">
        <p>
            Muted sourced will not be shown in your feed.
        </p>
    </div>

    @if(!count($mutes))
        <p class="mt-4">{{ __('You have no mutes configured.') }}</p>
    @endif

    <table class="table">
        <tbody>
            @foreach ($mutes as $mute)
                @if(!$mute->getMuteable())
                    @continue
                @endif
                <tr>
                    <td>
                        @if($mute->getMuteable() instanceof \Domain\Post\Models\Tag)
                            <span
                                class="tag"
                                style="--tag-color: {{ $mute->getMuteable()->color }}"
                            >
                                {{ $mute->getMuteable()->getName() }}
                            </span>
                        @else
                            {{ $mute->getMuteable()->getName() }}
                        @endif
                    </td>
                    <td class="text-right">
                        <x-post-button
                                :action="$mute->getMuteable()->getUnmuteUrl()"
                        >
                            <span class="underline hover:no-underline text-grey-darker text-sm">
                                {{ __('Unmute') }}
                            </span>
                        </x-post-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endcomponent
