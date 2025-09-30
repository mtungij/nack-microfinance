<!DOCTYPE html>
<html lang="sw">
  <head>
  
    <title>Mkataba wa Mkopo - <?= $compdata->comp_name ?></title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap");

      body {
        font-family: "Poppins", sans-serif;
        font-size: 10pt;
        line-height: 1.5;
        color: #000;
      }

      .page {
        page-break-after: always;
        width: 100%;
        position: relative;
      }
      .page:last-child {
        page-break-after: avoid;
      }

      .passport-placeholder-top {
        border: 2px solid black;
        height: 110px;
        width: 100px;
        margin: 0 auto;
      }

      .passport-box {
        border: 1.5px solid black;
        height: 140px;
        width: 120px;
        padding-top: 50px;
        text-align: center;
        font-weight: bold;
        margin: 0 auto;
      }

      .company-header h2 {
        font-size: 18pt;
        font-weight: 800;
        margin: 0;
        text-transform: uppercase;
      }
      .company-header p {
        font-size: 12pt;
        font-weight: 700;
        margin: 2px 0;
      }

      .red-line {
        border-bottom: 3px solid red;
        padding-bottom: 3px;
      }

      .main-title-box {
        border: 2px solid black;
        text-align: center;
        margin: 10px 0;
        padding: 5px;
        font-weight: 700;
        font-size: 11pt;
      }

      .input-box {
        border: 2px solid black;
        padding: 6px 10px;
        font-weight: bold;
        font-size: 10pt;
      }

      .stamp-box {
        border: 1.5px solid black;
        height: 100px;
        width: 180px;
        padding: 10px;
        text-align: center;
      }

      .fill-in {
        border-bottom: 1px dotted #000;
        padding: 0 5px;
      }

      .checkbox {
        display: inline-block;
        width: 25px;
        height: 18px;
        border: 1.5px solid #000;
        margin-right: 6px;
        vertical-align: middle;
      }

      ol,
      ul {
        padding-left: 25px;
        margin: 5px 0 10px 0;
      }

      li {
        padding-left: 10px;
        margin-bottom: 5px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      td {
        padding: 1px;
        vertical-align: top;
      }

      .bold {
        font-weight: bold;
      }

      .center {
        text-align: center;
      }

      hr {
        border: none;
        border-top: 1.5px solid #000;
        margin: 20px 0;
      }
    </style>
  </head>
  <body>
    <!-- PAGE 1 -->
    <div class="page">
      <table style="margin-bottom: 10px">
        <tr>
          <td style="width: 25%; vertical-align: middle">
    <div style="width:20px; height:30px; margin:0 auto; border:2px solid black; overflow:hidden; border-radius:50%;">
  <img
    src="<?= FCPATH . $customer->passport ?>"
    alt="Customer Image"
    style="width: 20%; height: 20%; object-fit: cover; display: block;"
  >
</div>


          </td>
          <td style="width: 50%; text-align: center; vertical-align: middle">
            <div class="company-header">
           <h2><?= strtoupper($compdata->comp_name) ?></h2>
              <p><?= strtoupper($compdata->adress) ?></p>
              <p class="red-line">PHONE NO. <?= strtoupper($compdata->comp_number) ?></p>
            </div>
          </td>
  
<td style="width: 25%; vertical-align: middle">
  <div style="width: 50px; height: 60px; margin: 0 auto; border: 2px solid black; overflow: hidden; border-radius: 5px;">
    <?php
      // Make sure the path is not empty before trying to display it
      if (!empty($mdhamini[0]->passport_path)) {
          // FCPATH provides the server path, e.g., /var/www/html/nack/
          // The database provides the rest of the path, e.g., assets/sponser_passport/image.jpg
          $image_path = FCPATH . $mdhamini[0]->passport_path;
    ?>
    <img
      src="<?= $image_path ?>"
      alt="Mdhamini Passport"
      style="width: 20%; height: 20%; object-fit: cover; display: block;"
    >
    <?php
      } else {
          // Optional: Show a placeholder or empty box if no image path exists
          echo 'No Image';
      }
    ?>
  </div>
</td>


        </tr>
      </table>
<?php
// Assume $loan_form contains your data from the database
// Let's use an example date for demonstration
// $loan_form->loan_day = '2025-07-25 21:12:00'; 

// 1. Create a DateTime object from your date string
$date_object = new DateTime($loan_form->loan_day);

// 2. Create an array of Swahili month names
$swahili_months = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Machi',
    4 => 'Aprili',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Julai',
    8 => 'Agosti',
    9 => 'Septemba',
    10 => 'Oktoba',
    11 => 'Novemba',
    12 => 'Desemba',
];

// 3. Get the specific parts you need from the date
$day = $date_object->format('d'); // Day of the month, e.g., "25"
$month_number = $date_object->format('n'); // Month number, e.g., "7"
$year_last_two = $date_object->format('y'); // Last two digits of the year, e.g., "25"

// 4. Look up the Swahili month name from the array
$month_name = $swahili_months[$month_number]; // Gets "Julai"
?>

      <div class="main-title-box">MKATABA WA MKOPO <?= strtoupper($compdata->comp_name) ?></div>

      <table style="margin-bottom: 15px">
        <tr>
          <td class="input-box" style="width: 48%">NAMBA YA MTEJA:</td>
          <td style="width: 4%"></td>
          <td class="input-box" style="width: 48%">NAMBA YA MKOPO:</td>
        </tr>
      </table>

    <p>
    Mkataba huu umefanyika leo tarehe
    <span class="fill-in" style="padding: 0 30px; text-align: center;">
        <?= $day ?>
    </span>
    mwezi
    <span class="fill-in" style="padding: 0 60px; text-align: center;">
        <?= $month_name ?>
    </span>
    mwaka 20<?= $year_last_two ?><span class="fill-in" style="padding: 0 20px; text-align: center;">
        
    </span>.
</p>
      <p>
        Kati ya <span class="fill-in" style="padding: 0 80px"></span
        ><span class="bold"><?= ucfirst(strtolower($compdata->comp_name)) ?></span>
, kampuni iliyosajiliwa kwa sheria za
        Tanzania wa S.L.P.<span class="fill-in" style="padding: 0 50px"></span>,
        Tanzania (Ambaye Katika Mkataba huu atajulikana kama
        <span class="bold">Mkopeshaji</span>)
      </p>
      <p class="center bold" style="margin: 8px 0">Na</p>
      <p>
        Bwa/Bi <span class="fill-in" style="padding: 0 200px"><span class="bold"><?= strtoupper($customer->f_name . " " . $customer->m_name . " " . $customer->l_name) ?></span>
</span>wa S.L.P ..................
        <span class="fill-in" style="padding: 0 200px"></span> (ambaye katika
        Mkataba huu atajulikana kama <span class="bold">Mkopaji</span>)Umaarufu
        <span class="fill-in" style="padding: 0 200px"></span>.Ambaye ni mkazi
        wa Wilaya ya<span class="fill-in" style="padding: 0 80px">...............</span>.Tarafa
        ya <span class="fill-in" style="padding: 0 80px">................</span>.Kata ya<span
          class="fill-in"
          style="padding: 0 80px"
        >...............</span
        >.Mtaa wa
        <span class="fill-in" style="padding: 0 80px">................</span>.Kitongoji cha
        <span class="fill-in" style="padding: 0 100px"></span>.Kazi yangu
        ni<span class="fill-in" style="padding: 0 120px">......................</span>.Kata ambayo
        kituo chako cha kazi hupatikana
        <span class="fill-in" style="padding: 0 200px"></span>.Tarafa<span
          class="fill-in"
          style="padding: 0 80px"
        ></span
        >.Mtaa<span class="fill-in" style="padding: 0 80px"></span>.Namba ya
        simu<span class="fill-in" style="padding: 0 60px"></span>./<span
          class="fill-in"
          style="padding: 0 60px"
        ></span
        >.tiki na jaza namba moja kati ya nyaraka zifuatazo, kadi ya mpiga kura
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span>
 kitambulisho cha Leseni ya udereva
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> Hati ya kusafiria
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> na kitambulisho cha makazi
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span>

        
      </p>

      <p>
        Ndoa:Hajaoa/Hajaolewa <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> ameoa/ameolewa
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> meachika/Mgane/Mjane
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span>
      </p>
      <p>
        Jina kamili la mwenza.<span
          class="fill-in"
          style="padding: 0 250px"
        >..................................</span>
      </p>

      <p>
        Umiliki wa makazi: kwako <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> umepanga
        <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> mengine eleza.................<span
          class="fill-in"
          style="padding: 0 180px"
        ></span>
      </p>
      <p>
        Nimechukua mkopo wa kiasi cha fedha za kitanzania Tsh.<span
          class="fill-in"
          style="padding: 0 200px"
        ><b><?=number_format($loan_form->loan_aprove  ) ?></b></span
        >
      </p>
      <p>
        Saini ya mkopaji....................<span class="fill-in" style="padding: 0 80px"></span>
        Dole gumba ................................<span class="fill-in" style="padding: 0 80px"></span> kwa
        hiari yangu mimi mwenyewe nakiri kukopa kiasi cha fedha niliyoiandika
        hapo juu nikiwa na akili timamu pasipo na shaka yeyote na ninakubali
        bila pingamizi lolote kuwa mkataba huu nimeusoma na kuelewa na kuwa
        nimeridhia kuwa mkataba huu kwangu mimi hauna utata wowote na ni jukumu
        langu yaliyomo na kuyatekeleza.
      </p>

      <p class="bold" style="margin-top: 15px; text-transform: uppercase">
        VIGEZO NA MASHARTI YA MKATABA HUU
      </p>
      <ol>
        <li>
          Kampuni inajihusisha na biashara ya fedha kwa maana ya ukopeshaji wa
          fedha kwa mujibu wa sheria.
        </li>
        <li>
          Pamoja na kampuni kujihusisha na biashara ya fedha kwa maana utoaji
          mikopo ijulikane kwamba kampuni itakuwa na mahusiano ya biashara na
          watu wenye sifa ya kuitwa wajasiriamali au wafanyabiashara wadogo
          wadogo wa aina zote.
        </li>
        <li>
          Ili mteja kukidhi vigezo na masharti mengine ya mkataba huu anapaswa
          kuwa na sifa zifuatazo:-
          <ol type="i" style="padding-left: 20px; margin-top: 5px">
            <li>
              Awe ni mtu mwenye akili timamu na awe hajawahi kuugua ugonjwa
              wowote wa akili.
            </li>
            <li>
              Awe ni mtu ambaye hajawahi kushtakiwa kwa kosa la madai/jinai
            </li>
          </ol>
        </li>
      </ol>
    </div>

    <!-- PAGE 2 -->
    <div class="page">
      <ol type="i" start="3" style="padding-left: 45px">
        <li>Awe ni mwenye umri usiopungua miaka 18, muwajibikaji na mkweli</li>
        <li>Awe ni mtu mwaminifu na mwenye kuheshimu mali za wengine</li>
      </ol>
      <ol start="4">
        <li>
          Marejesho ya mkopo huu yatalipwa kwa 
<?php
    $day = $loan_form->day;

    if ($day == 1) {
        echo '<span class="bold">' . strtoupper("kila siku") . '</span>';
    } elseif ($day == 7) {
        echo '<span class="bold">' . strtoupper("kila wiki") . '</span>';
    } elseif (in_array($day, [28, 29, 30, 31])) {
        echo '<span class="bold">' . strtoupper("kila mwezi") . '</span>';
    } else {
        echo '<span class="bold">' . strtoupper("kila siku $day") . '</span>';
    }
?>
 TSH.<b><?= number_format($loan_form->restration) ?></b>
<span
            class="fill-in"
            style="padding: 0 100px"
          ></span
          
          >
        </li>
        
        <li>
          Mkopaji kwa hiari yake mwenyewe anapaswa kuweka dhamana ya kitu ama
          vitu venye thamani kama sehemu ya ukiri wake wa kuwa na jukumu la
          kurejesha fedha, na endapo atashindwa kufanya hivyo, basi dhamana hizo
          zitakuwa ni mali halali za kampuni kwa mujibu wa sheria.
        </li>
        <li>
          Mkopaji atapaswa kuwa na mdhamini atakae tambulika kama mkopaji namba
          mbili na ambaye atakuwa na jukumu la kuhakikisha mkopaji namba moja
          analipa mkopo wake kwa wakati na endapo atashindwa kulipa kwa uzembe
          basi yeye atakuwa na jukumu la kulipa mkopo huo wote haraka.
        </li>
       
        <li>
          Mkopaji na mdhamini wote kwa pamoja wanapaswa kuwa na barua
          inayowatambulisha kutoka kwa viongozi wa serikali ya Mtaa wanakotoka
          na barua hiyo iwe imekidhi vigezo na masharti ya utambulisho wa
          kisheria.
        </li>
      </ol>

      <p class="bold" style="margin-top: 15px; text-transform: uppercase">
        ORODHA YA DHAMANA KWA MKOPAJI NA MDHAMINI
      </p>
      <ul>
          <?php if (!empty($collateral)): ?>
    <?php foreach ($collateral as $item): ?>
      <li>
        <span class="fill-in" style="display: block; width: 100%">&nbsp;</span>
        <span class="bold">
          <?= $item->description ?>

        </span>
      </li>
    <?php endforeach; ?>
  <?php else: ?>
        <li>
          <span class="fill-in" style="display: block; width: 100%"
            >&nbsp;</span
          ><span class="bold">Dhamana hazijajazwa</span>
        </li>
          <?php endif; ?>
      </ul>
      <hr />
      <h3 class="center bold" style="margin-bottom: 10px">
        SEHEMU YA MDHAMINI
      </h3>
      <p>
  <?php
$first_mdhamini = $mdhamini[0]; // Access the first sponsor

$full_mdhamini_name = strtoupper(
    $first_mdhamini->sp_name . ' ' .
    $first_mdhamini->sp_mname . ' ' .
    $first_mdhamini->sp_lname
);
?>
        Mimi Bw/Bi.<span class="fill-in" style="padding: 0 150px"><b><?= $full_mdhamini_name ?></b></span
        >.Umaarufu<span class="fill-in" style="padding: 0 150px"></span>.ni
        mkazi wa Wilaya ya
        <span class="fill-in" style="padding: 0 100px">............................</span>.Tarafa<span
          class="fill-in"
          style="padding: 0 100px"
        >.....................</span
        >.Kata.<span class="fill-in" style="padding: 0 100px">...........................</span> Mtaa.<span
          class="fill-in"
          style="padding: 0 100px"
        >.............................</span
        >.kitongoji cha<span class="fill-in" style="padding: 0 100px"></span
        >.<?php
$first_mdhamini = $mdhamini[0];
?>

Namba ya simu:
<span class="fill-in bold" style="padding: 0 100px">
  <?= $first_mdhamini->sp_phone_no ?>
</span>
       <?php
$first_mdhamini = $mdhamini[0];
?>

Kazi yangu:
<span class="fill-in bold" style="padding: 0 100px">
  <?= strtoupper($first_mdhamini->nature) ?>
</span>
.Kata
        ambayo kituo cha kazi hupatikana<span
          class="fill-in"
          style="padding: 0 200px"
        ></span
        >.Mtaa.<span class="fill-in" style="padding: 0 150px">........................</span>.namba moja
        kati ya nakala zifuatazo kadi ya mpiga kura <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span>hati ya kusafiria/Leseni ya
       <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span> udereva/kitambulisho cha utaifa na kitambulisho cha mkazi
       <span style="font-family: DejaVu Sans, sans-serif;">&#x2610;</span>
      </p>
      <p>
        <b>Kwa hiari yangu mwenyewe na nikiwa na akili timamu bila kushurutishwa na
        mtu yeyote nakubali kumdhamini</b> Bw/Bi.<span
          class="fill-in"
          style="padding: 0 400px"
        ><b><?= strtoupper($customer->f_name . " " . $customer->m_name . " " . $customer->l_name) ?></b></span
        >. Na ya kwamba nitakuwa tayari kwa lolote litakalojitokeza endapo
        niliye mdhamini ataenda kinyume na moja kati ya vigezo na masharti ya
        mkataba huu. Nipo tayari kumlipia endapo atashindwa kurejesha au
        kuchukuliwa dhamana zangu nilizoandikia kwa ajili ya kufidia deni lake.
      </p>

      <!-- <p>
        Ndoa: Hajaoa/hajaolewa <span class="checkbox"></span> amevaa/ameolewa
        <span class="checkbox"></span> ameachika/mgane/mjane
        <span class="checkbox"></span>
      </p> -->
      <!-- <p>
        Jina kamili la mwenza
        <span class="fill-in" style="padding: 0 200px"></span>.umaarufu
        <span class="fill-in" style="padding: 0 200px"></span>
      </p> -->
      <!-- <p>
        Umiliki wa makazi: Kwako <span class="checkbox"></span> umepanga
        <span class="checkbox"></span> mengine (eleza)<span
          class="fill-in"
          style="padding: 0 200px"
        ></span>
      </p> -->
      <p>
        Pesa tasilimu ninayomdhamini ni TSH.<span
          class="fill-in"
          style="padding: 0 200px"
        >.............................</span
        >.(kwa maneno)<span class="fill-in" style="padding: 0 200px">......................</span>
      </p>
      <p style="margin-top: 20px">
        SAINI YA MDHAMINI.<span class="fill-in" style="padding: 0 200px">....................................</span
        >.DOLE GUMBA.<span class="fill-in" style="padding: 0 200px">..................................</span>
      </p>
    </div>

    <!-- PAGE 3 -->
    <div class="page">
      <!-- <p class="bold" style="text-transform: uppercase">
        ORODHA YA DHAMANA KWA MDHAMINI
      </p> -->
      <!-- <ul>
        <li>
          <span class="fill-in" style="display: block; width: 100%"
            >&nbsp;</span
          >
        </li>
        <li>
          <span class="fill-in" style="display: block; width: 100%"
            >&nbsp;</span
          >
        </li>
        <li>
          <span class="fill-in" style="display: block; width: 100%"
            >&nbsp;</span
          >
        </li>
      </ul> -->
      <!-- <ul style="list-style-type: none; padding-left: 15px; margin-top: 20px">
        <li><span class="bold">&gt;</span> Muda wa mkopo ni siku 28/30</li>
        <li>
          <span class="bold">&gt;</span> Muda wa rejesho ni kuanzia saa 3:00
          asubuhi hadi saa 11:00 jioni
        </li>
        <li>
          <span class="bold">&gt;</span> Ukichelewa faini ni TSH 2,000/= AU
          zaidi
        </li>
        <li><span class="bold">&gt;</span> Ukilaza faini ni rejesho zima</li>
        <li>
          <span class="bold">&gt;</span> Ukishinda siku mbili umevunja mkataba,
          hivyo utatakiwa kurejesha fedha yote ya mkopo pamoja na riba au
          kuchukuliwa dhamana ulizoandikia hapo juu.
        </li>
      </ul> 
      <hr style="margin-top: 30px" />
      <p class="bold" style="text-transform: uppercase">
        AFISA WA KAMPUNI YA UKOPESHAJI
      </p>

    <table style="width: 100%; margin-top: 20px;">
  <tr>
    <td style="width: 65%; vertical-align: top;">
      <p>
        Jina:
        <span class="fill-in bold" style="padding: 0 250px;">
          <?= strtoupper($customer->empl_name) ?>
        </span>
      </p>
      <p>
        Wadhifa:
        <span class="fill-in" style="padding: 0 238px;">
          ................
        </span>
      </p>
      <p>
        Tarehe:
        <span class="fill-in" style="padding: 0 240px;">
          <?= date('Y-m-d', strtotime($loan_form->loan_day)) ?>
        </span>
      </p>
      <p>
        Sahihi:
        <span class="fill-in" style="padding: 0 245px;">
          .................
        </span>
      </p>
    </td>
    <td style="width: 35%; text-align: right; vertical-align: top;">
      <div class="stamp-box"><strong>Muhuri wa ofisi</strong></div>
    </td>
  </tr>
</table>

    </div>

    <!-- PAGE 4 -->
    <!-- <div class="page">
      <div class="company-header" style="text-align: center">
        <h2 style="font-size: 18pt">DEMO CREDIT LTD</h2>
        <p style="font-size: 12pt">P.O. BOX 152 DAR ES SALAAM</p>
      </div>

      <table style="margin-top: 15px; margin-bottom: 15px">
        <tr>
          <td style="width: 30%; text-align: center">
            <div class="passport-box">MTEJA</div>
          </td>
          <td
            style="
              width: 40%;
              text-align: left;
              vertical-align: middle;
              padding: 0 10px;
            "
          >
            <p
              style="
                border-bottom: 1px dotted #000;
                padding: 2px 0;
                margin-bottom: 5px;
              "
            >
              <span class="bold">OFISI YA SERIKALI YA MTAA WA</span
              >.................
            </p>
            <p
              style="
                border-bottom: 1px dotted #000;
                padding: 2px 0;
                margin-bottom: 5px;
              "
            >
              <span class="bold">KATA YA</span
              >..................................................
            </p>
            <p
              style="
                border-bottom: 1px dotted #000;
                padding: 2px 0;
                margin-bottom: 5px;
              "
            >
              <span class="bold">S.L.P</span
              >.......................................................
            </p>
            <p
              style="
                border-bottom: 1px dotted #000;
                padding: 2px 0;
                margin-bottom: 5px;
              "
            >
              <span class="bold">TAREHE</span
              >..................................................
            </p>
          </td>
          <td style="width: 30%; text-align: center">
            <div class="passport-box">MDHAMINI</div>
          </td>
        </tr>
      </table>

      <p>
        <span class="bold">Kumb Na</span
        ><span class="fill-in" style="padding: 0 150px"></span>
      </p>
      <p>
        <span class="bold">YAH: UTAMBULISHO WA NDUGU</span
        ><span class="fill-in" style="padding: 0 200px"></span>
      </p>

      <p style="margin-top: 10px">
        Rejea mada tajwa hapo juu,<br />
        Mtajwa ambaye picha yake imebandikwa hapo juu ni mkazi halali katika
        kijiji.Mtaa wa<span class="fill-in" style="padding: 0 50px"></span
        >.Alizaliwa tarehe<span class="fill-in" style="padding: 0 25px"></span
        >/<span class="fill-in" style="padding: 0 25px"></span>/<span
          class="fill-in"
          style="padding: 0 25px"
        ></span>
        katika Mkoa wa<span class="fill-in" style="padding: 0 100px"></span
        >.Wilaya ya<span class="fill-in" style="padding: 0 100px"></span>.Mtaa
        wa<span class="fill-in" style="padding: 0 100px"></span>.
        Ameowa/ameolewa na mme wake Anaitwa<span
          class="fill-in"
          style="padding: 0 250px"
        ></span
        >.
      </p>

      <p class="bold" style="margin-top: 15px">DHAMANA ZA MKOPAJI</p>
      <p>
        Dhamana zangu mimi mkopaji ni:-
        <span class="fill-in" style="width: 100%; display: block">&nbsp;</span>
        <span class="fill-in" style="width: 100%; display: block">&nbsp;</span>
      </p>

      <p style="margin-top: 15px">
        Ndugu ambaye picha yake ipo hapo juu, Nathibitisha kumfahamu mtu huyu
        vizuri na ninaomba asaidiwe katika ofisi yako.
      </p>

      <p class="bold" style="margin-top: 15px">NAMBA YA KITAMBULISHO CHA</p>
      <table style="width: 100%; text-align: center; margin-bottom: 10px">
        <tr>
          <td style="width: 33%"><span class="bold">KURA</span></td>
          <td style="width: 33%"><span class="bold">LESENI</span></td>
          <td style="width: 33%"><span class="bold">KINGINE</span></td>
        </tr>
        <tr>
          <td style="border-bottom: 1px dotted black; height: 20px"></td>
          <td style="border-bottom: 1px dotted black; height: 20px"></td>
          <td style="border-bottom: 1px dotted black; height: 20px"></td>
        </tr>
      </table>

      <p>
        Namba ya simu <span class="fill-in" style="padding: 0 250px"></span>
      </p>
      <p class="bold" style="margin-top: 15px">MDHAMINI</p>
      <p>
        Mdhamini wake ni<span class="fill-in" style="padding: 0 250px"></span
        ><br />
        Ameoa/ameolewa – mjane mgane – hajaoa/hajaolewa
        <span
          style="
            display: inline-block;
            border: 1.5px solid #000;
            width: 150px;
            height: 20px;
            vertical-align: middle;
          "
        ></span>
      </p>
      <p>
        Anaishi Mtaa wa<span class="fill-in" style="padding: 0 250px"></span>
      </p>
      <p>
        Dhamana ya mdhamini ni<span
          class="fill-in"
          style="padding: 0 220px"
        ></span>
      </p>
      <p>
        Simu namba<span class="fill-in" style="padding: 0 150px"></span> Sahihi
        <span class="fill-in" style="padding: 0 150px"></span>
      </p>

      <p style="margin-top: 15px">
        Wako<br />
        Mwenyekiti Mtaa au mjumbe<span
          class="fill-in"
          style="padding: 0 200px"
        ></span
        ><br />
        Jina<span class="fill-in" style="padding: 0 200px"></span>.cheo<span
          class="fill-in"
          style="padding: 0 150px"
        ></span
        ><br />
        Sahihi<span class="fill-in" style="padding: 0 180px"></span>.simu<span
          class="fill-in"
          style="padding: 0 150px"
        ></span
        ><br />
        Tarehe<span class="fill-in" style="padding: 0 300px"></span>
      </p>
      <div class="center" style="margin-top: 20px">
        <p style="font-weight: bold; margin: 0; line-height: 1.2">
          Tafadhali jaza nafasi zote kwa usahihi
        </p>
        <p
          style="
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            font-size: 12pt;
          "
        >
          0742 424 524
        </p>
      </div>
    </div> -->
  </body>
</html>
