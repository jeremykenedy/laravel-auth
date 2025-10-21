<div class="row">
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'facebook']), 'fa-brands fa-facebook', 'Facebook', array('class' => 'btn btn-block btn-social btn-facebook')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'twitter']), 'fa-brands fa-twitter', 'Twitter', array('class' => 'btn btn-block btn-social btn-twitter')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'google']), 'fa-brands fa-google-plus', 'Google +', array('class' => 'btn btn-block btn-social btn-google')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'github']), 'fa-brands fa-github', 'GitHub', array('class' => 'btn btn-block btn-social btn-github')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'youtube']), 'fa-brands-brands fa-youtube', 'YouTube', array('class' => 'btn btn-block btn-social btn-youtube btn-danger')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'twitch']), 'fa-brands fa-twitch', 'Twitch', array('class' => 'btn btn-block btn-social btn-twitch btn-info')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => 'instagram']), 'fa-brands fa-instagram', 'Instagram', array('class' => 'btn btn-block btn-social btn-instagram')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! html()->icon_link(route('social.redirect',['provider' => '37signals']), 'fa fa-signal', 'Basecamp', array('class' => 'btn btn-block btn-social btn-basecamp btn-warning')) !!}
    </div>
</div>
