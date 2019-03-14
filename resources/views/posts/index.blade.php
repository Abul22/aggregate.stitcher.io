@php
    /** @var \Domain\Post\Models\Post[] $posts */
    /** @var \Domain\User\Models\User|null $user */
    /** @var \Domain\Post\Models\Tag|null $currentTag */
    /** @var \Domain\Post\Models\Topic|null $currentTopic */
@endphp

@component('layouts.app', [
    'title' => $title,
])
    <div class="flex items-baseline justify-between">
        <nav class="text-sm text-grey-darker leading-normal md:pt-2 h-12 flex items-center justify-between border-t md:border-t-0 border-b border-grey-lighter w-full">
            <ul class="flex w-full">
                <li class="mr-6">
                    <active-link
                        :href="action([\App\Http\Controllers\PostsController::class, 'index'])"
                    >
                        {{ __('All') }}
                    </active-link>
                </li>
                {{--<li class="mr-6">--}}
                    {{--<active-link--}}
                        {{--:href="action([\App\Http\Controllers\PostsController::class, 'latest'])"--}}
                    {{-->--}}
                        {{--{{ __('Latest') }}--}}
                    {{--</active-link>--}}
                {{--</li>--}}
                <li class="mr-6">
                    <active-link
                        :href="action([\App\Http\Controllers\PostsController::class, 'top'])"
                    >
                        {{ __('Top this week') }}
                    </active-link>
                </li>
                <li class="ml-auto">
                    <a
                        href="{{ action([\App\Http\Controllers\GuestSourcesController::class, 'index']) }}"
                    >
                        <i class="far fa-lightbulb mr-2"></i>{{ __('Suggest a blog') }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <post-list
        :posts="$posts"
        :user="$user"
        :donationIndex="$donationIndex"
    ></post-list>
@endcomponent
