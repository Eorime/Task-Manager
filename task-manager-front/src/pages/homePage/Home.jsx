import { useEffect, useState } from "react";
import Navigation from "../../components/common/navigation/Navigation";
import { Container } from "./styles";
import TaskCard from "../../components/pages/homePage/taskCard/TaskCard";

const Home = () => {
	const [data, setData] = useState();

	useEffect(() => {
		fetch("/rest-api/api.php/tasks")
			.then((response) => response.json())
			.then((data) => {
				console.log("tasks array:", data.tasks);

				setData(data.tasks);
			});
	}, []);

	return (
		<Container>
			<Navigation />
			{data &&
				data.map((task) => <TaskCard key={task.id} taskData={task}></TaskCard>)}
		</Container>
	);
};

export default Home;
