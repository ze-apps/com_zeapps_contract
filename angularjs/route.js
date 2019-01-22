app.config(["$routeProvider",

	function ($routeProvider) {

		$routeProvider

		///////////////////////// CONTRACTS /////////////////////////
		//

		.when("/ng/com_zeapps_contract/contracts/liste", {
			templateUrl: "/com_zeapps_contract/contracts/liste",
			controller: "ComZeappsContractsListCtrl"
		})

		.when("/ng/com_zeapps_contract/contracts/configuration", {
			templateUrl: "/com_zeapps_contract/contracts/configuration",
			controller: "ComZeappsContractsConfigurationCtrl"
		})

		.when("/ng/com_zeapps_contract/contracts/view", {
			templateUrl: "/com_zeapps_contract/contracts/view",
			controller: "ComZeappsContractsViewCtrl"
		});

		/*.when("/ng/com_zeapps_contract/contracts/get/:id_contract", {
			templateUrl: "/com_zeapps_contract/contracts/view",
			controller: "ComZeappsContractsViewCtrl"
		});*/

	}]);

