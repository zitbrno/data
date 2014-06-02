<?php

namespace App\Controllers;

class Homepage extends \Katu\Controller {

	static function test() {
		foreach (\ZitBrno\Scrapers\MMB\ZapisyZeZastupitelstva::getRoky() as $rok) {
			foreach ($rok->getZapisy() as $zapis) {
				var_dump($zapis->getBody());
			}
		}
	}

	static function index() {
		set_time_limit(300);

		$res = array();

		$roky = \ZitBrno\Scrapers\MMB\ZapisyZeZastupitelstva::getRoky();
		foreach ($roky as $rok) {

			foreach ($rok->getZapisy() as $zapis) {

				$seznamHlasovani = $zapis->getSeznamHlasovani();
				foreach ($seznamHlasovani as $hlasovani) {

					$zapisCislo     = $hlasovani->getZapisCislo();
					$hlasovaniCislo = $hlasovani->getCislo();
					$hlasovaniNazev = $hlasovani->getNazev();
					$hlasovaniDatum = $hlasovani->getDatum();
					$bodCislo       = $hlasovani->getBodCislo();

					foreach ($hlasovani->getHlasy() as $hlas) {
						$res[] = array(
							'zapisCislo'     => $zapisCislo,
							'hlasovaniCislo' => $hlasovaniCislo,
							'hlasovaniNazev' => $hlasovaniNazev,
							'hlasovaniDatum' => $hlasovaniDatum,
							'bodCislo'       => $bodCislo,
							'jmeno'          => $hlas['person'],
							'strana'         => $hlas['party'],
							'hlas'           => $hlas['vote'],
						);
					}

				}

			}

		}

		$export = array();
		foreach ($res as $hlas) {
			$export[] = array(
				'zapisCislo'     => $hlas['zapisCislo'],
				'hlasovaniCislo' => $hlas['hlasovaniCislo'],
				//'hlasovaniNazev' => preg_replace('#\v+#', '; ', $hlas['hlasovaniNazev']),
				'hlasovaniDatum' => $hlas['hlasovaniDatum']->format('Y-m-d'),
				'hlasovaniCas'   => $hlas['hlasovaniDatum']->format('H:i:s'),
				'body'           => \Katu\Utils\JSON::encodeStandard($hlas['bodCislo']),
				'jmeno'          => $hlas['jmeno'],
				'strana'         => $hlas['strana'],
				'hlas'           => $hlas['hlas'],
			);
		}

		return \Katu\Utils\JSON::respond($export);
	}

}
