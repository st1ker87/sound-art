<h2>MODEL: Review, CRUD: show, AREA: admin - DETTAGLIO SINGOLA REVIEW</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/reviews/{slug} (get)</p>
<h5>SINGOLA REVIEW PASSATA</h5>
<p>review->id = @php echo $review->id @endphp</p>
<p>review->slug = @php echo $review->slug @endphp</p>
<p>dump($review) = @dump($review)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>