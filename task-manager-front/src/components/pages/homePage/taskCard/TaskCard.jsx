import React from "react";
import {
	BottomContainer,
	CalendarSvg,
	Container,
	DateContainer,
	PriorityContainer,
	PriorityLabel,
	StatusLabel,
	TaskDescription,
	TaskLine,
	TaskTitle,
	TextContainer,
	TopContainer,
} from "./styles";

const TaskCard = ({ taskData }) => {
	return (
		<Container>
			<TopContainer>
				<PriorityContainer>
					<PriorityLabel>{taskData.priority_id}</PriorityLabel>
				</PriorityContainer>
				<StatusLabel>{taskData.status_id}</StatusLabel>
			</TopContainer>
			<TextContainer>
				<TaskTitle>{taskData.title}</TaskTitle>
				<TaskDescription>{taskData.description}</TaskDescription>
			</TextContainer>
			<TaskLine></TaskLine>
		</Container>
	);
};

export default TaskCard;
