@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://d1unuvan7ts7ur.cloudfront.net/1500x0/filters:strip_exif()/a014fb64-2cf2-4382-bb75-77d808d5c1f4/01HYNKM5NB88EDBDZQQ4TD765T" class="logo" style="width: 180px" alt="Finarte Logo">
@endif
</a>
</td>
</tr>
