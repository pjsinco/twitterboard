        <strong>Leaders</strong>
        <ul class="side-nav">
          <li><a href="{{ route('tweets', 'leaders') }}">Leader tweets</a></li>
          <li><a href="{{ route('tweets', 'popular/leaders') }}">Popular leader tweets</a></li>
          <li><a href="{{ route('users.mentions-by', 'leaders') }}">Accounts most mentioned by leaders</a></li>
          <li><a href="{{ route('users.retweets-by', 'leaders') }}">Accounts most retweeted by leaders</a></li>
          <li><a href="{{ route('tags', 'leaders') }}">Top hashtags tweeted by leaders</a></li>
        </ul>
        <strong>Circle</strong>
        <ul class="side-nav">
          <li><a href="{{ route('tweets', 'circle') }}">All tweets</a></li>
          <li><a href="#">Search tweets</a></li>
          <li><a href="#">Search users</a></li>
          <li><a href="#">Most frequent mentioners</a></li>
          <li><a href="#">Most frequent retweeters</a></li>
          <li><a href="{{ route('tags', 'circle') }}">Tags tweeted by circle</a></li>
        </ul>
        <strong>Us</strong>
        <ul class="side-nav">
          <li><a href="{{ route('tweets', 'us') }}">All tweets</a></li>
          <li><a href="{{ route('tweets', 'popular/us') }}">Popular tweets</a></li>
          <li><a href="#">Most frequent mentioners of us</a></li>
          <li><a href="#">Most frequent retweeters of us</a></li>
          <li><a href="{{ route('users.retweets-by', 'us') }}">Accounts most retweeted by us</a></li>
          <li><a href="{{ route('tags', 'us') }}">Tags tweeted by us</a></li>
        </ul>
