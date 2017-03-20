<div class="row">
    <div class="col-md-12 margin-bottom-2 text-center">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fa fa-facebook', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-facebook')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => '']), 'fa fa-twitter', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-twitter')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fa fa-google-plus', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-google')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fa fa-github', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-github')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'youtube']), 'fa fa-youtube', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-youtube')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitch']), 'fa fa-twitch', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-twitch')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'instagram']), 'fa fa-instagram', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-instagram')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => '37signals']), 'fa fa-signal', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-basecamp')) !!}
    </div>
</div>