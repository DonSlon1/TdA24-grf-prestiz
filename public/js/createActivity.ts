// Define interfaces for structured data
interface HomePreparation {
    title: string;
    warn?: string;
    note?: string;
}

interface Instruction {
    title: string;
    warn?: string;
    note?: string;
}

interface FormData {
    uuid: string;
    activityName: string;
    description: string;
    objectives: string[];
    tools: string[];
    classStructure: string;
    lengthMin: number;
    lengthMax: number;
    edLevel: string[];
    homePreparation: HomePreparation[];
    instructions: Instruction[];
    // Extend with other fields as necessary
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('activityForm') as HTMLFormElement;
    const uuidInput = document.getElementById('uuid') as HTMLInputElement;

    uuidInput.addEventListener('input', enforceUUIDFormat);

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!validateForm()) {
            console.error('Form validation failed.');
            return;
        }

        const formData: FormData = collectFormData();
        console.log(formData); // Debugging: view the structured form data

        try {
            const response = await fetch('/api/activity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            });
            if (!response.ok) throw new Error('Network response was not ok.');

            const data = await response.json();
            console.log(data);
            alert('Aktivita byla úspěšně vytvořena.');
        } catch (error) {
            console.error('Error:', error);
            alert('Nepodařilo se vytvořit aktivitu.');
        }
    });
});

function enforceUUIDFormat(event: Event): void {
    const input = event.target as HTMLInputElement;
    let value = input.value.replace(/\W/gi, '').toLowerCase();
    // Format the UUID
    value = value.replace(/^(.{8})(.{4})(.{4})(.{4})(.{12}).*$/, '$1-$2-$3-$4-$5');
    input.value = value;
}

function validateForm(): boolean {
    // Implement validation logic, e.g., checking if UUID is in correct format
    // For now, just return true for simplicity
    return true;
}

// @ts-ignore
function collectFormData(): CustomFormData {
    const uuid = (document.getElementById('uuid') as HTMLInputElement).value;
    const activityName = (document.getElementById('activityName') as HTMLInputElement).value;
    const description = (document.getElementById('description') as HTMLTextAreaElement).value;
    const objectives = gatherInputValues('objectives[]');
    const tools = gatherInputValues('tools[]');
    const classStructure = (document.getElementById('classStructure') as HTMLSelectElement).value;
    const lengthMin = parseInt((document.getElementById('lengthMin') as HTMLInputElement).value, 10);
    const lengthMax = parseInt((document.getElementById('lengthMax') as HTMLInputElement).value, 10);
    const edLevel = gatherCheckboxValues('edLevelContainer');

    // Adjusting for homePreparation
    const homePreparation = gatherGroupInputValues('homePreparationsContainer', 'homePreparation');

    // Adjusting for instructions
    const instructions = gatherGroupInputValues('instructionsContainer', 'instructions');

    return {
        uuid,
        activityName,
        description,
        objectives,
        tools,
        classStructure,
        lengthMin,
        lengthMax,
        edLevel,
        homePreparation,
        instructions,
    };
}

function gatherGroupInputValues(containerId: string, groupName: string): any[] {
    const groups = document.querySelectorAll(`#${containerId} .input-group`);
    return Array.from(groups).map(group => {
        const inputs = group.querySelectorAll<HTMLInputElement>(`input[name^="${groupName}"]`);
        const groupData: { [key: string]: string } = {};
        inputs.forEach(input => {
            const match = input.name.match(new RegExp(`${groupName}\\[([\\w]+)\\]\\[\\]`));
            if (match && match[1]) {
                groupData[match[1]] = input.value;
            }
        });
        return groupData;
    });
}

function gatherInputValues(name: string): string[] {
    const inputs = document.querySelectorAll<HTMLInputElement>(`input[name="${name}"]`);
    return Array.from(inputs).map(input => input.value.trim()).filter(value => value !== '');
}

function gatherCheckboxValues(containerId: string): string[] {
    const checkboxes = document.querySelectorAll<HTMLInputElement>(`#${containerId} input[type="checkbox"]:checked`);
    return Array.from(checkboxes).map(checkbox => checkbox.value);
}

function addDynamicSection(containerId: string, inputsInfo: Array<{label: string, name: string, placeholder: string, type?: string}>): void {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Create a wrapper for the new set of inputs
    const groupWrapper = document.createElement('div');
    groupWrapper.className = 'input-group';

    inputsInfo.forEach(({ label, name, placeholder, type = 'text' }) => {
        const inputWrapper = document.createElement('div');
        inputWrapper.className = 'form-input';

        // Create and append the label
        const inputLabel = document.createElement('label');
        inputLabel.textContent = label;
        inputWrapper.appendChild(inputLabel);

        // Create and append the input
        const input = document.createElement('input');
        input.type = type;
        input.name = name;
        input.placeholder = placeholder;
        inputWrapper.appendChild(input);

        groupWrapper.appendChild(inputWrapper);
    });

    // Create and append the delete button
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Odstranit';
    deleteButton.type = 'button';
    deleteButton.className = 'delete-button';
    deleteButton.addEventListener('click', () => {
        groupWrapper.remove();
    });

    groupWrapper.appendChild(deleteButton);
    container.appendChild(groupWrapper);
}

function addObjective(): void {
    addDynamicSection('objectivesContainer', [{label: 'Cíl', name: 'objectives[]', placeholder: 'Přidejte cíl'}]);
}

function addTool(): void {
    addDynamicSection('toolsContainer', [{label: 'Nástroj', name: 'tools[]', placeholder: 'Přidejte nástroj'}]);
}

function addHomePreparation(): void {
    addDynamicSection('homePreparationsContainer', [
        {label: 'Příprava doma - Název', name: 'homePreparation[title][]', placeholder: 'Název'},
        {label: 'Příprava doma - Varování', name: 'homePreparation[warn][]', placeholder: 'Varování'},
        {label: 'Příprava doma - Poznámka', name: 'homePreparation[note][]', placeholder: 'Poznámka'}
    ]);
}

function addInstruction(): void {
    addDynamicSection('instructionsContainer', [
        {label: 'Instrukce - Název', name: 'instructions[title][]', placeholder: 'Název'},
        {label: 'Instrukce - Varování', name: 'instructions[warn][]', placeholder: 'Varování'},
        {label: 'Instrukce - Poznámka', name: 'instructions[note][]', placeholder: 'Poznámka'}
    ]);
}

function addAgenda(): void {
    addDynamicSection('agendaContainer', [
        {label: 'Agenda - Délka', name: 'agenda[duration][]', placeholder: 'Délka v minutách', type: 'number'},
        {label: 'Agenda - Název', name: 'agenda[title][]', placeholder: 'Název'},
        {label: 'Agenda - Popis', name: 'agenda[description][]', placeholder: 'Popis'}
    ]);
}

function addLink(): void {
    addDynamicSection('linksContainer', [
        {label: 'Odkaz - Název', name: 'links[title][]', placeholder: 'Název'},
        {label: 'Odkaz - URL', name: 'links[url][]', placeholder: 'URL'}
    ]);
}

function addGalleryItem(): void {
    addDynamicSection('galleryContainer', [
        {label: 'Galerie - Název', name: 'gallery[title][]', placeholder: 'Název'},
        {label: 'Galerie - Nízké rozlišení', name: 'gallery[lowRes][]', placeholder: 'URL nízkého rozlišení'},
        {label: 'Galerie - Vysoké rozlišení', name: 'gallery[highRes][]', placeholder: 'URL vysokého rozlišení'}
    ]);
}