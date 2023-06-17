
@include('Chatify::layouts.headLinks')
<div class="container mx-auto px-5 py-4" style=" max-height: 400px; padding: 10px; ">
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    {{-- <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}"> --}}
        {{-- Header and search bar --}}
        
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section hide">
                {{-- <p class="messenger-title"><span>Favoritesss</span></p> --}}
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Saved Messages --}}
               
                @if(auth()->check() && auth()->user()->is_admin)
                <p class="messenger-title"><span>Your Space</span></p>
                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
                
                {{-- Contact --}}
                <p class="messenger-title"><span>All Messages</span></p>
                <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
                @endif
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           
        </div>
    {{-- </div> --}}

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView  " >
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                                       
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    {{-- <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a> --}}
                    {{-- <a href="/"><i class="fas fa-home"></i></a> --}}
                    {{-- <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a> --}}
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please wait... if conversation screen not show  please <a style="color: blue" href="/home">Reload</a> the page</span></p>
            </div>

            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
</div>