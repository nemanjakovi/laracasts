@auth
    <x-panel>
      <form  method="POST" action="/posts/{{ $post->slug }}/comments">
        
        @csrf

        <header class="flex items-center">
            <img 
            src="https://i.pravatar.cc/60?u={{ auth()->id() }}" 
            alt="avatar picture" 
            width="40" 
            height="40" 
            class="rounded-full">
            <h2 class="ml-3">Want to participate?</h2>
        </header>

        <div class="mt-6">
            <textarea 
            name="body" 
            class="w-full text-sm" 
            rows="5" 
            placeholder="Quick, thing of something to say!" 
            required></textarea>
        </div>

        @error('body')
        <span class='text-red-500 text-xs mt-1'>{{ $message }}</span>
        @enderror

       <x-submit-button>Post</x-submit-button>
        
        </form>

    </x-panel>

    @else
    <p class="font-semibold">
    <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline"> Log in </a> to leave a comment.
    </p>

@endauth