import React from "react";
import { Container } from "./styles";

const TaskCard = ({ taskData }) => {
	return <Container>{taskData.title}</Container>;
};

export default TaskCard;
