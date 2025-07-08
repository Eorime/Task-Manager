import React, { useState } from "react";
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

	return <Container>CreateTask</Container>;
};

export default CreateTask;
