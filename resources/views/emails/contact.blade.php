<h1> {{$name}} vous a contacté sur {{ config('app.name', 'Laravel') }} </h1>

<p> {!! nl2br(e($bodyMessage)) !!} </p>