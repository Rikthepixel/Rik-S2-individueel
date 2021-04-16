<?php
require_once "/Route.php";

class Router {

   private $WebsiteRoutes = array();

   private static function AddRoute($Route)
   {
      array_push(self::$WebsiteRoutes, $Route);
   }

   private static function GetRoutesByMethod($Method)
   {
      $RoutesWithMethod = array();
      for ($i=0; $i < count(self::$WebsiteRoutes); $i++) { 

         if (self::$WebsiteRoutes[$i]->Method == $Method) {
            array_push($RoutesWithMethod, self::$WebsiteRoutes[$i]);
         }   

      }
      return $RoutesWithMethod;
   }

   public static function Route($RequestLocation) 
   {
      $RoutesWithMethod = self::GetRoutesByMethod($_SERVER['REQUEST_METHOD']);

      if (count($RoutesWithMethod) < 1) {
         //ToDo: Show Page not found
         return false;
      }

      for ($i=0; $i < count($RoutesWithMethod); $i++) { 
         if ($RoutesWithMethod[$i] == $RequestLocation) {
            $RoutesWithMethod[$i]->ExecuteCallback();
            return true;
         }
      }

      //ToDo Match $Routes->Location with $RouteLocation to get the desired route
      return false;
   }

   public static function Get($RouteLocation, $RouteCallback) 
   {
      if ($RouteLocation && $RouteCallback) {
         self::AddRoute(new Route($RouteLocation, $RouteCallback, "GET"));
      }
   }

   public static function Post($RouteLocation, $RouteCallback) 
   {
      if ($RouteLocation && $RouteCallback) {
         self::AddRoute(new Route($RouteLocation, $RouteCallback, "POST"));
      }
   }
}