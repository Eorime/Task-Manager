import React, { useEffect, useState } from "react";
import { Container } from "./styles";

const CreateTask = () => {
	const [taskData, setTaskData] = useState({
		title: "",
		description: "",
		assignedTo: "",
		department: "",
		dueDate: "",
		status: "",
		priority: "",
	});

	useEffect(() => {
		fetch("/rest-api/api.php/task", {
			method: "POST",
			body: JSON.stringify(taskData),
		});
	}, []);

	// aq forma gaakete, also header daschirdeba didi albatobit mxolod iq, sadac authentications itxovs
	return <Container>CreateTask</Container>;
};

export default CreateTask;
