<div class="row">
    <div class="col-12 mb-2 text-center">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fa-brands fa-facebook', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-facebook')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitter']), 'fa-brands fa-twitter', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-twitter')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fa-brands fa-google-plus', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-google')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fa-brands fa-github', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-github')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'youtube']), 'fa-brands fa-youtube', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-youtube')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitch']), 'fa-brands fa-twitch', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-twitch')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'instagram']), 'fa-brands fa-instagram', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-instagram')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => '37signals']), 'fa fa-signal', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-basecamp')) !!}
    </div>
</div>
