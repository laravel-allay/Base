{{ trans('allay::base.click_here_to_reset') }}: 
<a href="{{ $link = url(config('allay.base.route_prefix', 'admin').'/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
    {{ $link }}
</a>
