@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{ $date->translatedFormat('F') }} {{ $date->day }}
                , {{ $date->year }}  {{ $date->format('H:i') }} • {{ $post->comments->count() }} Коментаря</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="py-3">
                        @auth()
                            <form action="{{ route('post.likes.store', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                                </button>
                                <span>{{ $post->liked_users_count }}</span>
                            </form>
                        @endauth
                        @guest()
                            <div>
                                <i class="far fa-heart"></i>
                                <span>{{ $post->liked_users_count }}</span>
                            </div>
                        @endguest
                    </section>
                    @if($relatedPosts->count() > 0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Зв'язані пости</h2>
                            <div class="row">
                                @foreach($relatedPosts as $relatedPosts)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <a href="{{ route('posts.show', $relatedPosts->id) }}"
                                           class="blog-post-permalink">
                                            <img src="{{ asset('storage/' . $relatedPosts->preview_image) }}"
                                                 alt="related post"
                                                 class="post-thumbnail">
                                            <p class="post-category">{{ $relatedPosts->category->title }}</p>
                                            <h5 class="post-title">{{ $relatedPosts->title }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                    <section class="comment-list mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">Коментарі ({{ $post->comments->count() }})</h2>
                        @foreach($post->comments as $comment)
                            <div class="comment-text mb-3">
                                <div>
                                    <span class="username"> {{ $comment->user->name }}</span>
                                </div>
                                <span
                                    class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}
                                </span>
                                {{ $comment->message }}
                            </div>
                        @endforeach
                    </section>
                    @auth()
                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Відправити коментар</h2>
                            <form action="{{ route('post.comments.store', $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                    <textarea name="message" class="form-control" placeholder="Напишіть свій комментар"
                                              rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Відправити" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                    @endauth
                </div>
            </div>
        </div>
    </main>
@endsection
