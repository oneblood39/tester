<?php	
//  Google API PHP Client Kütüphanesi'ni yükledim.
require_once __DIR__ . '/api/vendor/autoload.php';
  
$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);
$results = getResults($analytics, $profile);
printResults($results);

function initializeAnalytics()
{
   //analyticsten indirdiğim json formatındaki dosya ve yolunu tanımladım.
  $KEY_FILE_LOCATION = __DIR__ . '/api/analytics-api-test-220618-370f3b37f450.json';

  // yeni bir client objesi tanımladım.
  $client = new Google_Client();
  $client->setApplicationName("Hello Analytics Reporting");
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics($client);

  return $analytics;
}

function getFirstProfileId($analytics) {
  // Kullanıcı profile_id'nin çekilmesi
  // bu kullanıcıya ait hesaplara ulaşılması
  $accounts = $analytics->management_accounts->listManagementAccounts();

  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
    $firstAccountId = $items[0]->getId();

    $properties = $analytics->management_webproperties
        ->listManagementWebproperties($firstAccountId);

    if (count($properties->getItems()) > 0) {
      $items = $properties->getItems();
      $firstPropertyId = $items[0]->getId();

      // kullanıcıya ait profillere bakılması
      $profiles = $analytics->management_profiles
          ->listManagementProfiles($firstAccountId, $firstPropertyId);

      if (count($profiles->getItems()) > 0) {
        $items = $profiles->getItems();

        // profil_id nin döndüğü yer
        return $items[0]->getId();

      } else {
        throw new Exception('Bu kullanıcıya ait profil bulunamadı.');
      }
    } else {
      throw new Exception('Bu kullanıcıya ait özellik bulunamadı.');
    }
  } else {
    throw new Exception('Bu kullanıcıya ait hesap bulunamadı.');
  }
}


function getResults($analytics, $profileId) {
	
  // Son 30 günlük veriyi çektim
   return $analytics->data_ga->get(
       'ga:' . $profileId,
       '30daysAgo',
       'today',
       'ga:sessions,ga:visits,ga:pageviews',
	   array('dimensions' => 'ga:city,ga:date','sort'=>'-ga:visits')
	   );
}

function printResults($results) {
  if (count($results->getRows()) > 0) {

    // Profil adını çektim
    $profileName = $results->getProfileInfo()->getProfileName();

    $rows = $results->getRows();
	//Toplam satır sayısı
    $sayi=count($rows);

for ($i = 1; $i < $sayi; $i++) {
  //Gelen verileri değişkenlere atadım
	$cities = $rows[$i][0];
	$dates = $rows[$i][1];
	$sessions = $rows[$i][2];
	$visits = $rows[$i][3];
	$pageviews = $rows[$i][4];
	
	//Tarihi formatladım
    $year=substr($dates,0,4);
    $month=substr($dates,4,2);
    $day=substr($dates,6,2);	
    $dates=$year.'-'.$month.'-'.$day;
	
echo '
<form method="post" action="index.php/sonuc/sonuckaydet">
<input type="hidden" name="profilname" value="'.$profileName.'">
<input type="hidden" name="sessions" value="'.$sessions.'">
<input type="hidden" name="cities" value="'.$cities.'">
<input type="hidden" name="dates" value="'.$dates.'">
<input type="hidden" name="visits" value="'.$visits.'">
<input type="hidden" name="pageviews" value="'.$pageviews.'">
<input type="submit" value="Kaydet">
</form>
  ';
  
  //Ekrana yazdırdım
    print "Kullanılan Profil Adı: $profileName\n<br>";
    print "Toplam Oturum Sayısı: $sessions\n<br>";
	print "Şehirler: $cities\n<br>";
	print "Tarihler: $dates\n<br>";
	print "Toplam Sayfa Ziyaret Sayısı: $visits\n<br>";
	print "Toplam Sayfa Görüntülenme Sayısı: $pageviews\n<br>";   
    print '<hr>';  
} 
		
  } else {
    print "Sonuç bulunamadı.\n";
  }
}










?>