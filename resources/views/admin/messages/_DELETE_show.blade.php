<h2>MODEL: Message, CRUD: show, AREA: admin - DETTAGLIO SINGOLO MESSAGGIO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/messages/{slug} (get)</p>
<h5>SINGOLO MESSAGGIO PASSATO</h5>
<p>message->id = @php echo $message->id @endphp</p>
<p>message->slug = @php echo $message->slug @endphp</p>
<p>dump($message) = @dump($message)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>