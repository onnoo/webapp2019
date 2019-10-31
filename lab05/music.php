<!DOCTYPE html>
<html lang="en">

<head>
    <title>Music Library</title>
    <meta charset="utf-8" />
    <link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
    <link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <h1>My Music Page</h1>

    <!-- Ex 1: Number of Songs (Variables) -->
    <?php
        $song_count = 1234
    ?>
    <p>
        I love music.
        I have <?= $song_count ?> total songs,
        which is over <?= (int) ($song_count / 10) ?> hours of music!
    </p>

    <!-- Ex 2: Top Music News (Loops) -->
    <!-- Ex 3: Query Variable -->
    <div class="section">
        <h2>Billboard News</h2>

        <ol>
            <?php
                $news_pages = 5;
                if (isset($_GET["newspages"])) {
                    $news_pages = $_GET["newspages"];
                }
    
                for ($i = 0; $i < $news_pages; $i++) {
                    $month = 11 - $i;
                    if ($month <= 0) {
                        $month = 12 - (-1 * $month % 12);
                    }
                    if ($month < 10) {
                        $month = '0' . $month;
                    }
                    if (11 - $i > 0) {
                        $year = 2019;
                    } else {
                        $year = 2018 - (int)(-1 * (11 - $i) / 12);
                    }
            ?>
            <li><a href="https://www.billboard.com/archive/article/<?= "{$year}{$month}" ?>"><?= "{$year}-{$month}" ?></a></li>
            <?php } ?>
        </ol>
    </div>




    <!-- Ex 4: Favorite Artists (Arrays) -->
    <?php
        $favorite_artists = array("Guns N' Roses", "Green Day", "Blink182");
        $favorite_artists[] = "Queen"
    ?>
    <!-- Ex 5: Favorite Artists from a File (Files) -->
    <?php
        $favorite_artists = file("favorite.txt", FILE_IGNORE_NEW_LINES);
    ?>
    <div class="section">
        <h2>My Favorite Artists</h2>

        <ol>
            <?php
                foreach ($favorite_artists as $artist) {
                    $under_artist = implode("_", explode(" ", $artist))
            ?>
            <li><a href="http://en.wikipedia.org/wiki/<?= $under_artist ?>"><?= $artist ?></a></li>
            <?php } ?>
        </ol>
    </div>

    <!-- Ex 6: Music (Multiple Files) -->
    <?php
        $songs = glob("lab5/musicPHP/songs/*.mp3");
    ?>
    <!-- Ex 7: MP3 Formatting -->
    <div class="section">
        <h2>My Music and Playlists</h2>

        <ul id="musiclist">
            <?php
                foreach ($songs as $song) {
                    $song_name = explode("/", $song)[3];
                    $song_size = (int)(filesize($song) / 1024);
                    $size_list[$song_name] = $song_size;
                }
                asort($size_list);
                $size_list = array_reverse($size_list);
                
                foreach ($size_list as $name => $size) {
                    $song_path = "lab05/musicPHP/songs/{$name}"
            ?>
            <li class="mp3item">
                <a href="<?= $song_path ?>" download><?= $name ?></a> (<?= $size ?> KB)
            </li>
            <?php } ?>

            <!-- Exercise 8: Playlists (Files) -->
            <?php
                $playlists = glob("lab5/musicPHP/songs/*.m3u");
                $playlists = array_reverse($playlists);
                foreach ($playlists as $playlist) {
                    $playlist_name = explode("/", $playlist)[3];
            ?>
            <li class="playlistitem"><?= $playlist_name ?>:
                <ul>
                    <?php
                        $lines = file($playlist);
                        shuffle($lines);
                        foreach ($lines as $line) {
                            if (strpos($line, "#") === FALSE) {
                    ?>
                    <li><?= $line ?></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>

    <div>
        <a href="https://validator.w3.org/check/referer">
            <img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
        </a>
        <a href="https://jigsaw.w3.org/css-validator/check/referer">
            <img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
        </a>
    </div>
</body>

</html>
