import React, { useEffect, useState } from "react";
import { Container } from "./styles";
import Navigation from "../../components/common/navigation/Navigation";

const Employees = () => {
	const [data, setData] = useState();

	useEffect(() => {
		fetch("/rest-api/api.php/employees")
			.then((response) => response.json())
			.then((data) => {
				console.log(data);
				setData(data.employees);
			});
	}, []);

	return (
		<Container>
			<Navigation />
			{data &&
				data.map((employee, index) => <div key={index}> {employee.name}</div>)}
		</Container>
	);
};

export default Employees;
