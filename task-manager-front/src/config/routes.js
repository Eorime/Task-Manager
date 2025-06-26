import { Component } from "react";
import { routes } from "../constants/routes";
import Home from "../pages/homePage/Home";

export const appRoutes = [
	{
		path: routes.home,
		Component: Home,
	},
];
